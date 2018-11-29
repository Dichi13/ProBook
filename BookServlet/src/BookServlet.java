import java.io.*;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.json.simple.*;
import org.json.simple.parser.*;
import java.sql.*;

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
			//respwriter.append(volumes.toString());
			long resultnum = (long)volumes.get("totalItems"); 
			if (resultnum > 0) {
				JSONArray books = (JSONArray)volumes.get("items");
				JSONArray filtered = new JSONArray();
				
				for (int i = 0; i < books.size(); i++)  {
					JSONObject book = new JSONObject();
					JSONObject searchinfo = (JSONObject) ((JSONObject)books.get(i)).get("searchInfo");
					JSONObject volumeinfo = (JSONObject) ((JSONObject)books.get(i)).get("volumeInfo"); 
					if (searchinfo == null || volumeinfo== null)
						continue;
					//respwriter.append(volumeinfo.toString());
					//respwriter.append(searchinfo.toJSONString());
					
					//respwriter.append("1");
					book.put("title", (volumeinfo.get("title")));
					//respwriter.append("2");
					book.put("author", (volumeinfo.get("authors")));
					//respwriter.append("3");
					book.put("shortDesc", (searchinfo.get("textSnippet")));
					//respwriter.append("4");
					book.put("longDesc", (volumeinfo.get("description")));
					//respwriter.append("5");
					book.put("img", ((JSONObject)volumeinfo.get("imageLinks")).get("thumbnail"));
					//respwriter.append("YeY");
					respwriter.append("<br><br>"+book.toString());
					filtered.add(book);
				}
				
				ResultSet rs = SQLConn.query("SELECT * FROM bookprice");
				respwriter.append(rs.toString());
			}
			
		} catch (Exception e) {
			System.out.println(e.toString());
		}
		
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}
	
	public void getRecommendation() {
		
	}
	
	public void getBook() {
		
	}

}
