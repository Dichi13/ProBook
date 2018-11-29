import java.io.*;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.json.simple.*;
import org.json.simple.parser.*;

/**
 * Servlet implementation class BookServlet
 */

@WebServlet("/BookServlet")
public class BookServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
    private String message;
    /**
     * @see HttpServlet#HttpServlet()
     */
    public BookServlet() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		PrintWriter respwriter = response.getWriter();
		String searchtype = request.getParameter("t");
		String query = request.getParameter("q");
		respwriter.append(query+"<br>");
		respwriter.append("Served at: ").append(request.getContextPath());
		
		try {
			JSONObject volumes = BooksAPI.queryGoogleBooks(query, searchtype);
			respwriter.append(volumes.toString());
			int resultnum = (int)volumes.get("totalItems"); 
			if (resultnum > 0) {
				JSONArray books = (JSONArray)volumes.get("items");
				JSONArray filtered = new JSONArray();
				for (int i = 0; i < books.size(); i++)  {
					JSONObject book = new JSONObject();
					book.put("title", ((JSONObject)((JSONObject)books.get(i)).get("volumeInfo")).get("title"));
					book.put("author", ((JSONObject)((JSONObject)books.get(i)).get("volumeInfo")).get("authors"));
					book.put("shortDesc", ((JSONObject)((JSONObject)books.get(i)).get("searchInfo")).get("textSnippet"));
					book.put("longDesc", ((JSONObject)((JSONObject)books.get(i)).get("volumeInfo")).get("description"));
					book.put("img", ((JSONObject)((JSONObject)((JSONObject)books.get(i)).get("searchInfo")).get("imageLinks")).get("thumbnail"));
					filtered.add(book);
				}
			}
			
		} catch (Exception e) {
			message = e.toString();
		}
		
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
