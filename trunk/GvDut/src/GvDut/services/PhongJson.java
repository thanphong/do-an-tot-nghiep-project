package GvDut.services;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class PhongJson {
	private int id;
	private String maphong;
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getMaphong() {
		return maphong;
	}
	public void setMaphong(String maphong) {
		this.maphong = maphong;
	}
	public String toJson() {
		
		return new JSONSerializer().exclude("*.class").serialize(this);
	}

	public static PhongJson fromJsonToObject(String json) {
		return new JSONDeserializer<PhongJson>().use(null,
				PhongJson.class).deserialize(json);
	}

	public static Collection<PhongJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<PhongJson>>()
				.use(null, ArrayList.class).use("values", PhongJson.class)
				.deserialize(json);
	}

	public static String toJsonArray(Collection<PhongJson> collection) {

		return new JSONSerializer().exclude("*.class").serialize(collection);
	}
}
