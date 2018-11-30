package com;
import javax.jws.WebMethod;
import javax.jws.WebService;

@WebService
public interface CoreFunction {
	
	@WebMethod
	String getBook(String query, String accesstype);
	
	@WebMethod
	String getRecommendation(String book_id, String categories);
	
	@WebMethod
	int buyBook(String book_id, int num, long account);	
}


