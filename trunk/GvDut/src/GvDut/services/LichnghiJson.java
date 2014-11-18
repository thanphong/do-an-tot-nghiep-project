package GvDut.services;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class LichnghiJson {
	private int id;
	private String malhp;
	private String tenLhp;
	private String ngayngi;
	private String ngaybao;
	private int sotiet;
	private int sotietbu;
	private String jsondaybu;
	private List<LichbaobuJson> lichbaobuJsons;

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
	 * @param ngaybao
	 *            the ngaybao to set
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
	 * @param sotiet
	 *            the sotiet to set
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
	 * @param sotietbu
	 *            the sotietbu to set
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
	 * @param jsondaybu
	 *            the jsondaybu to set
	 */
	public void setJsondaybu(String jsondaybu) {
		this.jsondaybu = jsondaybu;
	}

	public List<LichbaobuJson> getLichbaobuJsons() {
		return lichbaobuJsons;
	}

	public void setLichbaobuJsons(List<LichbaobuJson> lichbaobuJsons) {
		this.lichbaobuJsons = lichbaobuJsons;
	}

	public String getMalhp() {
		return malhp;
	}

	public void setMalhp(String malhp) {
		this.malhp = malhp;
	}

	public String getTenLhp() {
		return tenLhp;
	}

	public void setTenLhp(String tenLhp) {
		this.tenLhp = tenLhp;
	}

	public String toJson() {
		jsondaybu = LichbaobuJson.toJsonArray(lichbaobuJsons);
		return new JSONSerializer().exclude("*.class").exclude("jsondaybu")
				.serialize(this);
	}

	public static LichnghiJson fromJsonToObject(String json) {
		return new JSONDeserializer<LichnghiJson>().use(null,
				LichnghiJson.class).deserialize(json);
	}

	public static Collection<LichnghiJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<LichnghiJson>>()
				.use(null, ArrayList.class).use("values", LichnghiJson.class)
				.deserialize(json);
	}

	public static String toJsonArray(Collection<LichnghiJson> collection) {

		return new JSONSerializer().exclude("*.class").serialize(collection);
	}

}
