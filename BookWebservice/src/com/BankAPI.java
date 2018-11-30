package com;

import java.io.*;
import java.net.URL;
import java.net.HttpURLConnection;
import org.json.simple.*;
import org.json.simple.parser.*;

public class BankAPI {
	private static final String BookAccount = "1234567890123456";
	
	public static Boolean requestTransfer(String userAccount, long amount) {
		try {
			URL url = new URL("http://localhost:3000/transfer");
			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
			conn.setRequestMethod("POST");
			
			conn.setDoOutput(true);
			OutputStream os = conn.getOutputStream();
			
			String postParams = "sender="+userAccount+"&receiver="+BookAccount+"&amount="+amount;
			os.write(postParams.getBytes());
			os.flush();
			os.close();
			
			int responseCode = conn.getResponseCode();
			System.out.println("bank POST Response Code :: " + responseCode);

			if (responseCode == HttpURLConnection.HTTP_OK) { //success
				BufferedReader in = new BufferedReader(new InputStreamReader(conn.getInputStream()));
				String response = in.readLine();
				JSONParser parser = new JSONParser();
				JSONObject resp = (JSONObject)parser.parse(response);
				System.out.println("RESP bank: "+response);
				if ((String)resp.get("values") == "Transaction Success") {
					return true;
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return false;
	}
}
