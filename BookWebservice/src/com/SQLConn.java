package com;

import java.sql.*;

public class SQLConn {
	static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
	static final String DB_URL = "jdbc:mysql://localhost:3306/bookservlet";
	
	private static final String USER = "root";
	private static final String PASS = "";
	
	Connection conn;
	Statement stmt;
	ResultSet rs;
	
	public void connect() {
		conn = null;
	    stmt = null;
	    try{
	      //STEP 2: Register JDBC driver
		   //System.out.println("db_1");
		   Class.forName("com.mysql.cj.jdbc.Driver");
	      //STEP 3: Open a connection
		   conn = DriverManager.getConnection(DB_URL,USER,PASS);
	    } catch (Exception e) {
	    	System.out.println("Error connecting");
	    }
	}
	
	public void close() {
		try {
			stmt.close();
			conn.close();
		} catch (Exception e) {
	    	System.out.println("Error closing");			
		}
	}
	
	
	public ResultSet query(String sqlquery) {
		try {
			stmt = conn.createStatement();
		    //sqlquery = "SELECT * FROM bookprice;"
		    rs = stmt.executeQuery(sqlquery);
		    //System.out.println(rs.getInt(1));
	    //STEP 6: Clean-up environment
		    return rs;
	   }catch(SQLException se){
	      //Handle errors for JDBC
	      se.printStackTrace();
	   }catch(Exception e){
	      //Handle errors for Class.forName
	      e.printStackTrace();
	   }/*finally{
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
	   }//end try*/
	   return null;
	}
}
