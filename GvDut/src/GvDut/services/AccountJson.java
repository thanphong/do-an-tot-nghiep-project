package GvDut.services;



import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

public class AccountJson {

	private int accountId;
	private String accountName;
	private String pass;
	//Duyhn-19/8/2014
	public int getAccountId() {
		return accountId;
	}

	public void setAccountId(int accountId) {
		this.accountId = accountId;
	}

	public String getAccountName() {
		return accountName;
	}

	public void setAccountName(String accountName) {
		this.accountName = accountName;
	}
	public String getPass() {
		return pass;
	}

	public void setPass(String pass) {
		this.pass = pass;
	}
	public String toJson() {
		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static AccountJson fromJsonToObject(String json) {
		return new JSONDeserializer<AccountJson>().use(null, AccountJson.class)
				.deserialize(json);
	}

}
