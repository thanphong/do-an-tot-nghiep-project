package GvDut.Net;

import java.util.ArrayList;
import android.content.BroadcastReceiver;
import GvDut.services.GetDataJson;
import GvDut.services.SmsJson;

import android.content.ContentResolver;
import android.content.Context;
import android.content.Intent;


import android.os.AsyncTask;
import android.os.Bundle;
import android.telephony.SmsMessage;
import android.telephony.SmsManager;
import android.widget.Toast;

public class SmsReceiver extends BroadcastReceiver {
	// All available column names in SMS table
	// [_id, thread_id, address,
	// person, date, protocol, read,
	// status, type, reply_path_present,
	// subject, body, service_center,
	// locked, error_code, seen]

	public static final String SMS_EXTRA_NAME = "pdus";
	public static final String SMS_URI = "content://sms";

	public static final String ADDRESS = "address";
	public static final String PERSON = "person";
	public static final String DATE = "date";
	public static final String READ = "read";
	public static final String STATUS = "status";
	public static final String TYPE = "type";
	public static final String BODY = "body";
	public static final String SEEN = "seen";

	public static final int MESSAGE_TYPE_INBOX = 1;
	public static final int MESSAGE_TYPE_SENT = 2;

	public static final int MESSAGE_IS_NOT_READ = 0;
	public static final int MESSAGE_IS_READ = 1;

	public static final int MESSAGE_IS_NOT_SEEN = 0;
	public static final int MESSAGE_IS_SEEN = 1;
	// Change the password here or give a user possibility to change it
	public static final byte[] PASSWORD = new byte[] { 0x20, 0x32, 0x34, 0x47,
			(byte) 0x84, 0x33, 0x58 };

	public void onReceive(Context context, Intent intent) {
		// Get SMS map from Intent
		Bundle extras = intent.getExtras();

		String messages = "";

		if (extras != null) {
			// Get received SMS array
			Object[] smsExtra = (Object[]) extras.get(SMS_EXTRA_NAME);

			// Get ContentResolver object for pushing encrypted SMS to incoming
			// folder
			ContentResolver contentResolver = context.getContentResolver();
			String body = "";
			String address = "";
			for (int i = 0; i < smsExtra.length; ++i) {
				SmsMessage sms = SmsMessage.createFromPdu((byte[]) smsExtra[i]);

				body = sms.getMessageBody().toString();
				address = sms.getOriginatingAddress();

				messages += "SMS from " + address + " :\n";
				messages += body + "\n";

				// Here you can add any your code to work with incoming SMS
				// I added encrypting of all received SMS

				// putSmsToDatabase( contentResolver, sms );

			}
			Toast.makeText(context, messages, Toast.LENGTH_SHORT).show();
			sendSms(context, address, body);

			// Display SMS message

		}
	}

	public void sendSms(Context context, final String numberphone,
			final String message) {
		try {

			final SmsJson lichnghiJson = new AsyncTask<String, Void, SmsJson>() {
				@Override
				protected SmsJson doInBackground(String... params) {
					// TODO Auto-generated method stub
					return GetDataJson.sendsms(numberphone, message);
				}
			}.execute("").get();
			if (lichnghiJson != null) {
				 sendSMSMessage(context,lichnghiJson.getPhonenumber(),lichnghiJson.getContent());
				 
			} else {
				SmsJson lichnghiJsons = new SmsJson();
				lichnghiJsons.setPhonenumber(numberphone);
				lichnghiJsons
						.setContent("Tin nhan sai cu phap vui long soan tin nhan:HD goi den 01649568431 de xem huong dan.");
				sendSMSMessage(context, lichnghiJsons.getPhonenumber(),
						lichnghiJsons.getContent());
			}
		} catch (Exception e) {
			e.printStackTrace();
			// TODO: handle exception
		}
	}

	// WARNING!!!
	// If you uncomment next line then received SMS will not be put to incoming.
	// Be careful!
	// this.abortBroadcast();
	public void sendSMSMessage(Context context, String phoneNum, String mess) {

		try {
			SmsManager smsManager = SmsManager.getDefault();
			ArrayList<String> msgArray = smsManager.divideMessage(mess);

			smsManager.sendMultipartTextMessage("+"+phoneNum, null, msgArray, null,
					null);
			Toast.makeText(context, mess, Toast.LENGTH_LONG).show();
		} catch (Exception e) {
			Toast.makeText(context, "SMS faild, please try again.",
					Toast.LENGTH_LONG).show();
			e.printStackTrace();
		}
	}

}
