import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

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
       message = "Hello World";
    }
 
    public void doGet(HttpServletRequest request, HttpServletResponse response)
       throws ServletException, IOException {
       
       // Set response content type
       response.setContentType("text/html");
 
       // Actual logic goes here.
       PrintWriter out = response.getWriter();
       out.println("<h1>" + message + "</h1>");
    }
 
    public void destroy() {
       // do nothing.
    }
 }