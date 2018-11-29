import java.sql.*;
import com.mysql.cj.jdbc.Driver;

public class SQLConn {
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
	static final String DB_URL = "jdbc:mysql://localhost:3306/bookservlet";
	
	private static final String USER = "root";
	private static final String PASS = "";
	
	Connection conn;
	
	public static void insert() {
		
	}
	
	public static void select() {
		
	}
	
	
	public static ResultSet query(String sqlquery) {
	   Connection conn = null;
	   Statement stmt = null;
	   try{
	      //STEP 2: Register JDBC driver
		   System.out.println("db_1");
		   Class.forName("com.mysql.cj.jdbc.Driver");
	      //STEP 3: Open a connection
	      conn = DriverManager.getConnection(DB_URL,USER,PASS);
	      System.out.println("db_2");
	      //STEP 4: Execute a query
	      stmt = conn.createStatement();
	      
	      //test
	      //sqlquery = "SELECT * FROM bookprice";
	      ResultSet rs = stmt.executeQuery(sqlquery);
	      System.out.println(rs.toString());
	      System.out.println(rs.toString());
	    //STEP 6: Clean-up environment
	      stmt.close();
	      conn.close();
	      return rs;
	   }catch(SQLException se){
	      //Handle errors for JDBC
	      se.printStackTrace();
	   }catch(Exception e){
	      //Handle errors for Class.forName
	      e.printStackTrace();
	   }finally{
	      //finally block used to close resources
	      try{
	         if(stmt!=null)
	            stmt.close();
	      }catch(SQLException se2){
	      }// nothing we can do
	      try{
	         if(conn!=null)
	            conn.close();
	      }catch(SQLException se){
	         se.printStackTrace();
	      }//end finally try
	   }//end try
	   return null;
	}
}
