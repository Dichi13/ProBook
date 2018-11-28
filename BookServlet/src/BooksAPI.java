import java.io.*;
import java.net.URLEncoder;
import java.text.NumberFormat;
import com.google.api.client.googleapis.javanet.GoogleNetHttpTransport;
import com.google.api.client.json.JsonFactory;
import com.google.api.services.books.Books;
import com.google.api.services.books.BooksRequestInitializer;
import com.google.api.services.books.Books.Volumes.List;
import com.google.api.services.books.model.Volume;
import com.google.api.services.books.model.Volumes;


public class BooksAPI {
	public static final String APPLICATION_NAME = "BookServlet";
    private static final NumberFormat CURRENCY_FORMATTER = NumberFormat.getCurrencyInstance();
    private static final NumberFormat PERCENT_FORMATTER = NumberFormat.getPercentInstance();

    public static String queryGoogleBooks(JsonFactory jsonFactory, String query) throws Exception {
	      APIClient.errorIfNotSpecified();
	      StringWriter output = new StringWriter();
	      PrintWriter toOut = new PrintWriter(output);
	      // Set up Books client.
	      final Books books = new Books.Builder(GoogleNetHttpTransport.newTrustedTransport(), jsonFactory, null)
	          .setApplicationName(APPLICATION_NAME)
	          .setGoogleClientRequestInitializer(new BooksRequestInitializer(APIClient.API_KEY))
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
}
