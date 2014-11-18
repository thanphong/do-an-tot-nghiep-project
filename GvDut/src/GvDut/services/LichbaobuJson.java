package GvDut.services;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class LichbaobuJson {
	private int id;
	private int lichnghi;
	private int sotietbu;
	private String maphong;
	private String ngayday;
	private String ngaybao;
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
	public String getNgayday() {
		return ngayday;
	}
	public void setNgayday(String ngayday) {
		this.ngayday = ngayday;
	}
	public String getNgaybao() {
		return ngaybao;
	}
	public void setNgaybao(String ngaybao) {
		this.ngaybao = ngaybao;
	}
	/**
	 * @return the lichnghi
	 */
	public int getLichnghi() {
		return lichnghi;
	}
	/**
	 * @param lichnghi the lichnghi to set
	 */
	public void setLichnghi(int lichnghi) {
		this.lichnghi = lichnghi;
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
	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static LichbaobuJson fromJsonToObject(String json) {
		return new JSONDeserializer<LichbaobuJson>().use(null, LichbaobuJson.class)
				.deserialize(json);
	}
	public static Collection<LichbaobuJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<LichbaobuJson>>()
				.use(null, ArrayList.class).use("values", LichbaobuJson.class)
				.deserialize(json);
	}
	
}
