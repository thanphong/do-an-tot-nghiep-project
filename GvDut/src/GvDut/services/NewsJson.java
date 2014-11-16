package GvDut.services;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;


import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class NewsJson {

	private String tieude;
	private String noidung;
	private int id;
	private String ngay;
	public String getTieude() {
		return tieude;
	}
	public void setTieude(String tieude) {
		this.tieude = tieude;
	}
	public String getNoidung() {
		return noidung;
	}
	public void setNoidung(String noidung) {
		this.noidung = noidung;
	}
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static NewsJson fromJsonToObject(String json) {
		return new JSONDeserializer<NewsJson>().use(null, NewsJson.class)
				.deserialize(json);
	}
	public static Collection<NewsJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<NewsJson>>().use(null, ArrayList.class)
				.use("values", NewsJson.class).deserialize(json);
	}
	public String getNgay() {
		return ngay;
	}
	public void setNgay(String ngay) {
		this.ngay = ngay;
	}

}
