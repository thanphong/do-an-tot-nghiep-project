package GvDut.services;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class LichnghiJson {
	private int id;
	private String ngayngi;
	private String lopHp;
	private String malophp;
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getNgayngi() {
		return ngayngi;
	}
	public void setNgayngi(String ngayngi) {
		this.ngayngi = ngayngi;
	}
	public String getLopHp() {
		return lopHp;
	}
	public void setLopHp(String lopHp) {
		this.lopHp = lopHp;
	}
	public String getMalophp() {
		return malophp;
	}
	public void setMalophp(String malophp) {
		this.malophp = malophp;
	}
	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static LichnghiJson fromJsonToObject(String json) {
		return new JSONDeserializer<LichnghiJson>().use(null, LichnghiJson.class)
				.deserialize(json);
	}
}
