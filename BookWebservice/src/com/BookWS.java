package com;

import javax.jws.WebMethod;
import javax.jws.WebService;
import java.io.*;
import org.json.simple.*;
import org.json.simple.parser.*;
import java.sql.*;

@WebService
public class BookWS implements CoreFunction {
	
	private static final Boolean initDB = true;
	
	public BookWS(){
	}		
	
	private JSONArray filterResult(JSONObject result) {
		JSONArray books = (JSONArray)result.get("items");
		JSONArray filtered = new JSONArray();
		
		for (int i = 0; i < books.size(); i++)  {
			JSONObject book = new JSONObject();
			JSONObject saleinfo = (JSONObject) ((JSONObject)books.get(i)).get("saleInfo");
			JSONObject searchinfo = (JSONObject) ((JSONObject)books.get(i)).get("searchInfo");
			JSONObject volumeinfo = (JSONObject) ((JSONObject)books.get(i)).get("volumeInfo"); 
			if (searchinfo == null || volumeinfo== null)
				continue;
			//respwriter.append(volumeinfo.toString());
			//respwriter.append(searchinfo.toJSONString());
			
			book.put("title", (volumeinfo.get("title")));
			
			JSONArray isbn = (JSONArray)volumeinfo.get("industryIdentifiers");
			if (isbn!=null) {
				book.put("isbn", ((JSONObject)(isbn).get(0)).get("identifier"));
				
//				if (initDB && saleinfo.get("retailPrice") != null) {
	//				SQLConn conn = SQLConn
		//		}
				
			} else {
				continue;
			}
				
			book.put("author", (volumeinfo.get("authors")));
			
			JSONArray categ = (JSONArray)volumeinfo.get("categories");
			if (categ != null) {
				book.put("category", categ.get(0));
			} else {
				book.put("category", "");
			}
			
			book.put("shortDesc", (searchinfo.get("textSnippet")));
			
			book.put("longDesc", (volumeinfo.get("description")));
			
			JSONObject links = (JSONObject)volumeinfo.get("imageLinks");
			if (links != null) {
				book.put("img", links.get("thumbnail"));
			} else { //no thumbnail default pic
				book.put("img", "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1024px-No_image_3x4.svg.png");
			}
			
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
	@WebMethod
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
		return "[]";
	}
	
	@WebMethod
	public String getRecommendation(String book_id, String category) {
		String sqlquery = "SELECT book_id, sum(total) FROM purchased WHERE category='"+category
				+"' AND book_id<>'"+book_id+"' GROUP BY book_id ORDER BY sum(total) DESC limit 1;";
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
	
	@WebMethod
	public int buyBook(String book_id, int num, String account) {
		// calculate price amount
		long amount = num;
		SQLConn conn = new SQLConn();
		conn.connect();
		String sqlquery = "SELECT price FROM bookprice WHERE book_id='"+ book_id +"'";
		try {
			ResultSet rs = conn.query(sqlquery);
			if (rs.next()) {
				amount *= rs.getLong(1);
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			conn.close();
		}
		// request transfer to bankws
		Boolean transfered = BankAPI.requestTransfer(account, amount);
		System.out.println("Transfer is complete = "+transfered);
		//if success, create and insert purchased row to db
		if (transfered) {
			try {
				conn.connect();
				JSONParser parser = new JSONParser();
				JSONArray books = (JSONArray) parser.parse(getBook(book_id, "isbn"));
				JSONObject book = (JSONObject) books.get(0);
				String category = (String)(book).get("category");
				sqlquery = "INSERT INTO purchased (book_id, category, total) "
						 + "VALUES ('"+book_id+"','"+category+"', "+num+")";
				conn.update(sqlquery);
				
				sqlquery = "SELECT LAST_INSERT_ID() as id_transaksi";
				ResultSet rs = conn.query(sqlquery);
				rs.next();
				int purchase_id = rs.getInt(1);
			
				return purchase_id;
			} catch (Exception e) {
				e.printStackTrace();
			} finally {
				conn.close();
			}
		}
		//transaction failed
		return -1;
	}
}
