package GvDut.services;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class TkbBaonghiJson {

	private int id;
	private String lichnghi;
	private List<LichnghiJson> lichnghiJsons;

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getLichnghi() {
		return lichnghi;
	}

	public void setLichnghi(String lichnghi) {
		this.lichnghi = lichnghi;
	}

	public List<LichnghiJson> getLichnghiJsons() {
		return lichnghiJsons;
	}

	public void setLichnghiJsons(List<LichnghiJson> lichnghiJsons) {
		this.lichnghiJsons = lichnghiJsons;
	}

	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}

	public static TkbBaonghiJson fromJsonToObject(String json) {
		return new JSONDeserializer<TkbBaonghiJson>().use(null,
				TkbBaonghiJson.class).deserialize(json);
	}

	public static Collection<TkbBaonghiJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<TkbBaonghiJson>>()
				.use(null, ArrayList.class).use("values", TkbBaonghiJson.class)
				.deserialize(json);
	}
}
