import java.io.*;
import java.net.URL;
import java.net.URLEncoder;
import java.net.HttpURLConnection;
import org.json.simple.*;
import org.json.simple.parser.*;

public class BooksAPI {
	private static final String newLine  = System.getProperty("line.separator");
	private static final String APIkey = "AIzaSyB1VsjBx7OkK5jRdcDr8UXy6lssKRyY4-c";
	
	public static JSONObject queryGoogleBooks(String query, String stype) {
		try {
			String type = stype != null ? stype : "intitle";
			String urlstring = "https://www.googleapis.com/books/v1/volumes?q="+type+":"+URLEncoder.encode(query, "UTF-8")+"&key="+APIkey; 
			
			URL url = new URL(urlstring);
			HttpURLConnection con = (HttpURLConnection) url.openConnection();
			
			String readstream = readStream(con.getInputStream());
			
			JSONParser parser = new JSONParser();
			try {
				JSONObject volumes = (JSONObject) parser.parse(readstream);
				return volumes;
			} catch (ParseException pe) {
				JSONObject err = (new JSONObject());
				err.put("ParseError", pe.toString());
				return err;
			}
		} catch (Exception e){
			JSONObject err = (new JSONObject());
			err.put("Exception", e.toString());
			return err;
		}
	}
	
	private static String readStream(InputStream in) {
        StringBuilder sb = new StringBuilder();
        try (BufferedReader reader = new BufferedReader(new InputStreamReader(in));) {
            String nextLine = "";
            while ((nextLine = reader.readLine()) != null) {
                sb.append(nextLine + newLine);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return sb.toString();
    }
}
