package GvDut.services;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class SmsJson {
	private String phonenumber;
	private String content;
	public String getPhonenumber() {
		return phonenumber;
	}
	public void setPhonenumber(String phonenumber) {
		this.phonenumber = phonenumber;
	}
	public String getContent() {
		return content;
	}
	public void setContent(String content) {
		this.content = content;
	}
	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static SmsJson fromJsonToObject(String json) {
		return new JSONDeserializer<SmsJson>().use(null, SmsJson.class)
				.deserialize(json);
	}
	public static Collection<SmsJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<SmsJson>>().use(null, ArrayList.class)
				.use("values", SmsJson.class).deserialize(json);
	}
	public static String toJsonArray(Collection<SmsJson> collection) {
		return new JSONSerializer().exclude("*.class").serialize(collection);
	}
}
