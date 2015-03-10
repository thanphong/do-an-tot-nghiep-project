package util;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class LabCon implements AppConstant {
	Connection con = null;
	public Connection getLocalConnection() {

		try {
			Class.forName(driver);
			con = DriverManager.getConnection(url, user, pass);
			return con;
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}
	public ResultSet excuteSql(String sql){
		try {
			con=getLocalConnection();
			Statement statement=con.createStatement();
			return statement.executeQuery(sql);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}
	public int excuteUpdate(String sql){
		
		try {
			con=getLocalConnection();
			Statement statement=con.createStatement();
			return statement.executeUpdate(sql);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		return 0;
		
	}
}
