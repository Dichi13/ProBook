
public class APIClient {
	static final String API_KEY =
	        "AIzaSyB1VsjBx7OkK5jRdcDr8UXy6lssKRyY4-c";
	        //+ APIClient.class;
	  
	    static void errorIfNotSpecified() {
	      if (API_KEY.startsWith("Enter ")) {
	        System.err.println(API_KEY);
	        System.exit(1);
	      }
	    }
}
