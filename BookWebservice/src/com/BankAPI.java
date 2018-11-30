package com;

import java.io.*;
import java.net.URL;
import java.net.HttpURLConnection;

public class BankAPI {
	private static final long BookAccount = 12345678;
	
	public static Boolean requestTransfer(long userAccount, long amount) {
		try {
			URL url = new URL("localhost:3000/transfer");
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
				if (response == "Transaction Success") {
					return true;
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		return false;
	}
}
