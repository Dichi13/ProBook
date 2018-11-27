import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

import java.io.IOException;
import java.net.URLEncoder;
import java.text.NumberFormat;

import com.google.api.client.googleapis.javanet.GoogleNetHttpTransport;
import com.google.api.client.json.JsonFactory;
import com.google.api.client.json.jackson2.JacksonFactory;
import com.google.api.services.books.Books;
import com.google.api.services.books.BooksRequestInitializer;
import com.google.api.services.books.Books.Volumes.List;
import com.google.api.services.books.model.Volume;
import com.google.api.services.books.model.Volumes;



public class BookServlet extends HttpServlet {
 
    private String message;
 
    public void init() throws ServletException {
       // Do required initialization
       //message = "Hello World";
    }
 
    public void doGet(HttpServletRequest request, HttpServletResponse response)
       throws ServletException, IOException {
       JsonFactory jsonFactory = JacksonFactory.getDefaultInstance();
        //get query
       String que = request.getParameter("query");
       try{
            message = BooksSample.queryGoogleBooks(jsonFactory, que);
       } catch(Exception e) {
            message = "Error";
       }
       // create a response
       response.setContentType("text/html");
 
       // Actual logic goes here.
       PrintWriter out = response.getWriter();
       out.println("<h1>" + message + "</h1>");
    }
 
    public void destroy() {
       // do nothing.
    }
 }


class BooksSample {

    /**
     * Be sure to specify the name of your application. If the application name is {@code null} or
     * blank, the application will log a warning. Suggested format is "MyCompany-ProductName/1.0".
     */
    private static final String APPLICATION_NAME = "BookServlet";
    
    private static final NumberFormat CURRENCY_FORMATTER = NumberFormat.getCurrencyInstance();
    private static final NumberFormat PERCENT_FORMATTER = NumberFormat.getPercentInstance();
  
    public static String queryGoogleBooks(JsonFactory jsonFactory, String query) throws Exception {
      ClientCredentials.errorIfNotSpecified();
      StringWriter output = new StringWriter();
      PrintWriter toOut = new PrintWriter(output);
      // Set up Books client.
      final Books books = new Books.Builder(GoogleNetHttpTransport.newTrustedTransport(), jsonFactory, null)
          .setApplicationName(APPLICATION_NAME)
          .setGoogleClientRequestInitializer(new BooksRequestInitializer(ClientCredentials.API_KEY))
          .build();
      // Set query string and filter only Google eBooks.
      toOut.println("Query: [" + query + "]");
      List volumesList = books.volumes().list(query);
      volumesList.setFilter("ebooks");
  
      // Execute the query.
      Volumes volumes = volumesList.execute();
      if (volumes.getTotalItems() == 0 || volumes.getItems() == null) {
        toOut.println("No matches found.");
        return output.toString();
      }
  
      // Output results.
      for (Volume volume : volumes.getItems()) {

        
        Volume.VolumeInfo volumeInfo = volume.getVolumeInfo();
        Volume.SaleInfo saleInfo = volume.getSaleInfo();
        toOut.println("==========");
        // Title.
        toOut.println("Title: " + volumeInfo.getTitle());
        // Author(s).
        java.util.List<String> authors = volumeInfo.getAuthors();
        if (authors != null && !authors.isEmpty()) {
          toOut.print("Author(s): ");
          for (int i = 0; i < authors.size(); ++i) {
            toOut.print(authors.get(i));
            if (i < authors.size() - 1) {
              toOut.print(", ");
            }
          }
          toOut.println();
        }
        // Description (if any).
        if (volumeInfo.getDescription() != null && volumeInfo.getDescription().length() > 0) {
          toOut.println("Description: " + volumeInfo.getDescription());
        }
        // Ratings (if any).
        if (volumeInfo.getRatingsCount() != null && volumeInfo.getRatingsCount() > 0) {
          int fullRating = (int) Math.round(volumeInfo.getAverageRating().doubleValue());
          toOut.print("User Rating: ");
          for (int i = 0; i < fullRating; ++i) {
            toOut.print("*");
          }
          toOut.println(" (" + volumeInfo.getRatingsCount() + " rating(s))");
        }
        // Price (if any).
        if (saleInfo != null && "FOR_SALE".equals(saleInfo.getSaleability())) {
          double save = saleInfo.getListPrice().getAmount() - saleInfo.getRetailPrice().getAmount();
          if (save > 0.0) {
            toOut.print("List: " + CURRENCY_FORMATTER.format(saleInfo.getListPrice().getAmount())
                + "  ");
          }
          toOut.print("Google eBooks Price: "
              + CURRENCY_FORMATTER.format(saleInfo.getRetailPrice().getAmount()));
          if (save > 0.0) {
            toOut.print("  You Save: " + CURRENCY_FORMATTER.format(save) + " ("
                + PERCENT_FORMATTER.format(save / saleInfo.getListPrice().getAmount()) + ")");
          }
          toOut.println();
        }
        // Access status.
        String accessViewStatus = volume.getAccessInfo().getAccessViewStatus();
        String message = "Additional information about this book is available from Google eBooks at:";
        if ("FULL_PUBLIC_DOMAIN".equals(accessViewStatus)) {
          message = "This public domain book is available for free from Google eBooks at:";
        } else if ("SAMPLE".equals(accessViewStatus)) {
          message = "A preview of this book is available from Google eBooks at:";
        }
        toOut.println(message);
        // Link to Google eBooks.
        toOut.println(volumeInfo.getInfoLink());
      }
      toOut.println("==========");
      toOut.println(
          volumes.getTotalItems() + " total results at http://books.google.com/ebooks?q="
          + URLEncoder.encode(query, "UTF-8"));
      
          return output.toString();
    }
  

    public static void main(String[] args) {
      JsonFactory jsonFactory = JacksonFactory.getDefaultInstance();
      try {
        // Verify command line parameters.
        if (args.length == 0) {
          System.err.println("Usage: BooksSample [--author|--isbn|--title] \"<query>\"");
          System.exit(1);
        }
        // Parse command line parameters into a query.
        // Query format: "[<author|isbn|intitle>:]<query>"
        String prefix = null;
        String query = "";
        for (String arg : args) {
          if ("--author".equals(arg)) {
            prefix = "inauthor:";
          } else if ("--isbn".equals(arg)) {
            prefix = "isbn:";
          } else if ("--title".equals(arg)) {
            prefix = "intitle:";
          } else if (arg.startsWith("--")) {
            System.err.println("Unknown argument: " + arg);
            System.exit(1);
          } else {
            query = arg;
          }
        }
        if (prefix != null) {
          query = prefix + query;
        }
        try {
          queryGoogleBooks(jsonFactory, query);
          // Success!
          return;
        } catch (IOException e) {
          System.err.println(e.getMessage());
        }
      } catch (Throwable t) {
        t.printStackTrace();
      }
      System.exit(0);
    }
  }



/**
 * API key found in the <a href="https://code.google.com/apis/console?api=books">Google apis
 * console</a>.
 * 
 * <p>
 * Once at the Google apis console, click on "Add project...". If you've already set up a project,
 * you may use that one instead, or create a new one by clicking on the arrow next to the project
 * name and click on "Create..." under "Other projects". Finally, click on "API Access". Look for
 * the section at the bottom called "Simple API Access".
 * </p>
 * 
 * @author Ravi Mistry
 */
class ClientCredentials {

    /** Value of the "API key" shown under "Simple API Access". */
    static final String API_KEY =
        "AIzaSyB1VsjBx7OkK5jRdcDr8UXy6lssKRyY4-c"
        + ClientCredentials.class;
  
    static void errorIfNotSpecified() {
      if (API_KEY.startsWith("Enter ")) {
        System.err.println(API_KEY);
        System.exit(1);
      }
    }
  }