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
	int buyBook(long isbn, int num, long account);	
}


