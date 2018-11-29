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
			//JSONObject volumes = BooksAPI.queryGoogleBooks(query, searchtype);
			//respwriter.append(volumes.toString());
			
			respwriter.append(getBook("9781642752021", "isbn"));
			
			respwriter.append("<br><br>");
			respwriter.append(getBook("Comics & Graphic Novels", "subject"));
			
			
			
		} catch (Exception e) {
			System.out.println(e.toString());
			e.printStackTrace();
		}
		
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}
	
	
	private JSONArray filterResult(JSONObject result) {
		JSONArray books = (JSONArray)result.get("items");
		JSONArray filtered = new JSONArray();
		
		for (int i = 0; i < books.size(); i++)  {
			JSONObject book = new JSONObject();
			JSONObject searchinfo = (JSONObject) ((JSONObject)books.get(i)).get("searchInfo");
			JSONObject volumeinfo = (JSONObject) ((JSONObject)books.get(i)).get("volumeInfo"); 
			if (searchinfo == null || volumeinfo== null)
				continue;
			//respwriter.append(volumeinfo.toString());
			//respwriter.append(searchinfo.toJSONString());
			
			book.put("title", (volumeinfo.get("title")));
			
			book.put("isbn", ((JSONObject)((JSONArray)volumeinfo.get("industryIdentifiers")).get(0)).get("identifier"));
			
			book.put("author", (volumeinfo.get("authors")));

			book.put("category", (String)((JSONArray)volumeinfo.get("categories")).get(0));
			
			book.put("shortDesc", (searchinfo.get("textSnippet")));
			
			book.put("longDesc", (volumeinfo.get("description")));
			
			book.put("img", ((JSONObject)volumeinfo.get("imageLinks")).get("thumbnail"));
			
			filtered.add(book);
		}
		return filtered;
	}
	
	public void addBookPrice(JSONObject book) {
		String isbn = (String)book.get("isbn");
		
		String sqlquery = "SELECT price FROM bookprice WHERE book_id='"+isbn+"';";
		
		SQLConn conn = new SQLConn();
		conn.connect();
		ResultSet rs = conn.query(sqlquery);
		try {
			if (rs.next()) {
				book.put("price", rs.getInt(1));
			} else {
				book.put("price", -1);
			}
		} catch (Exception e){
			System.out.println("Add price error");
			System.out.println(e.toString());
			e.printStackTrace();
		} finally {
			conn.close();
		}
	}
	
	// accesstype isbn, intitle, subject
	public String getBook(String query, String accesstype) {
		try {
			JSONObject volumes = BooksAPI.queryGoogleBooks(query, accesstype);
			long resultnum = (long)volumes.get("totalItems");
			if (resultnum > 0) {
				JSONArray filtered = filterResult(volumes);
				for (int i = 0; i < filtered.size(); i++) {
					addBookPrice((JSONObject)filtered.get(i));
				}
				return filtered.toJSONString();
			}
		} catch (Exception e) {
			System.out.println("Getbook error");
			e.printStackTrace();
		}
		return null;
	}
	
	public String getRecommendation(String book_id, String category) {
		String sqlquery = "SELECT book_id, sum(total) FROM purchased WHERE category='"+category
				+"' AND book_id<>'"+book_id+"' GROUP BY book_id SORT BY sum(total) DESC limit 1;";
		SQLConn conn = new SQLConn();
		conn.connect();
		try {
			ResultSet rs = conn.query(sqlquery);
			if (rs.next()) {
				return getBook(rs.getString(1), "isbn");
			} else {
				return getBook(category, "subject");
			}
		} catch (Exception e) {
			System.out.println(e.toString());
			e.printStackTrace();
		} finally {
			conn.close();
		}
		return null;
	}
	
	public int buyBook(long isbn, int num, long account) {
		return -1;
	}
	
}
