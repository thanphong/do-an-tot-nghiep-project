package GvDut.services;



import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class LichnghiJson {
	private int id;
	private String ngayngi;
	private String ngaybao;
	private int sotiet;
	private int sotietbu;
	private String jsondaybu;
	private String maLophp;
	private String lophp;
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
	/**
	 * @return the ngaybao
	 */
	public String getNgaybao() {
		return ngaybao;
	}
	/**
	 * @param ngaybao the ngaybao to set
	 */
	public void setNgaybao(String ngaybao) {
		this.ngaybao = ngaybao;
	}
	/**
	 * @return the sotiet
	 */
	public int getSotiet() {
		return sotiet;
	}
	/**
	 * @param sotiet the sotiet to set
	 */
	public void setSotiet(int sotiet) {
		this.sotiet = sotiet;
	}
	/**
	 * @return the sotietbu
	 */
	public int getSotietbu() {
		return sotietbu;
	}
	/**
	 * @param sotietbu the sotietbu to set
	 */
	public void setSotietbu(int sotietbu) {
		this.sotietbu = sotietbu;
	}
	/**
	 * @return the jsondaybu
	 */
	public String getJsondaybu() {
		return jsondaybu;
	}
	/**
	 * @param jsondaybu the jsondaybu to set
	 */
	public void setJsondaybu(String jsondaybu) {
		this.jsondaybu = jsondaybu;
	}
	public String getMaLophp() {
		return maLophp;
	}
	public void setMaLophp(String maLophp) {
		this.maLophp = maLophp;
	}
	public String getLophp() {
		return lophp;
	}
	public void setLophp(String lophp) {
		this.lophp = lophp;
	}
	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static LichnghiJson fromJsonToObject(String json) {
		return new JSONDeserializer<LichnghiJson>().use(null, LichnghiJson.class)
				.deserialize(json);
	}
	public static Collection<LichnghiJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<LichnghiJson>>()
				.use(null, ArrayList.class).use("values", LichnghiJson.class)
				.deserialize(json);
	}
}
