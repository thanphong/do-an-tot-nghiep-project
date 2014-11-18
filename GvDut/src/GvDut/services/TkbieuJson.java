package GvDut.services;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;
import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class TkbieuJson {
	private String lophp;
	private int thu;
	private int idlichday;
	private String maphong;
	private int tutiet,dentiet;
	private int baongi;
	private String ngaynghi;
	private int sotietnghi;
	private String lydo;

	public String getLophp() {
		return lophp;
	}
	public void setLophp(String lophp) {
		this.lophp = lophp;
	}
	public int getThu() {
		return thu;
	}
	public void setThu(int thu) {
		this.thu = thu;
	}
	public String getMaphong() {
		return maphong;
	}
	public void setMaphong(String maphong) {
		this.maphong = maphong;
	}
	public int getTutiet() {
		return tutiet;
	}
	public void setTutiet(int tutiet) {
		this.tutiet = tutiet;
	}
	public int getDentiet() {
		return dentiet;
	}
	public void setDentiet(int dentiet) {
		this.dentiet = dentiet;
	}
	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static TkbieuJson fromJsonToObject(String json) {
		return new JSONDeserializer<TkbieuJson>().use(null, TkbieuJson.class)
				.deserialize(json);
	}
	public static Collection<TkbieuJson> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<TkbieuJson>>().use(null, ArrayList.class)
				.use("values", TkbieuJson.class).deserialize(json);
	}
	public static String toJsonArray(Collection<TkbieuJson> collection) {
		return new JSONSerializer().exclude("*.class").serialize(collection);
	}
	public int getBaongi() {
		return baongi;
	}
	public void setBaongi(int baongi) {
		this.baongi = baongi;
	}
	public String getNgaynghi() {
		return ngaynghi;
	}
	public void setNgaynghi(String ngaynghi) {
		this.ngaynghi = ngaynghi;
	}
	public int getIdlichday() {
		return idlichday;
	}
	public void setIdlichday(int idlichday) {
		this.idlichday = idlichday;
	}
	/**
	 * @return the sotietnghi
	 */
	public int getSotietnghi() {
		return sotietnghi;
	}
	/**
	 * @param sotietnghi the sotietnghi to set
	 */
	public void setSotietnghi(int sotietnghi) {
		this.sotietnghi = sotietnghi;
	}
	/**
	 * @return the lydo
	 */
	public String getLydo() {
		return lydo;
	}
	/**
	 * @param lydo the lydo to set
	 */
	public void setLydo(String lydo) {
		this.lydo = lydo;
	}
	@Override
	public String toString() {
		return "TkbieuJson [lophp=" + lophp + ", thu=" + thu + ", maphong="
				+ maphong + ", tutiet=" + tutiet + ", dentiet=" + dentiet
				+ ", baongi=" + baongi + ", ngaynghi=" + ngaynghi + "]";
	}
	
}
