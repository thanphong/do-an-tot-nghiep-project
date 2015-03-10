package controller;

import java.io.IOException;
import java.io.Serializable;


import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;




import java.util.Map;

import javax.faces.bean.ManagedBean;
import javax.faces.bean.SessionScoped;


import javax.faces.context.ExternalContext;
import javax.faces.context.FacesContext;

import util.LabCon;
import model.Student;

@ManagedBean
@SessionScoped

public class StudentBean implements Serializable{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private Student student;
	private LabCon labCon;
	public Student getStudent() {
		return student;
	}

	public void setStudent(Student student) {
		this.student = student;
	}
	public StudentBean(){
		student=new Student();
		labCon=new LabCon();
	}

	public LabCon getLabCon() {
		return labCon;
	}

	public void setLabCon(LabCon labCon) {
		this.labCon = labCon;
	}
	public List<Student> getListStudent(){
		try {
			List<Student>students=new ArrayList<Student>();
			String sql="SELECT * FROM student";
			ResultSet rs=labCon.excuteSql(sql);
			while(rs.next()){
				Student student=new Student();
				student.setName(rs.getString("name"));
				students.add(student);
			}
			return students;
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}
	public String insertStudent(){
		String sql="INSERT into student(name) values('"+student.getName()+"')";
		labCon.excuteUpdate(sql);
		return "welcom";
	}
	public String sumNum(){
		 
		Map<String,String> params = FacesContext.getCurrentInstance().getExternalContext().getRequestParameterMap();
		int a=Integer.parseInt(params.get("a"));
		int b=Integer.parseInt(params.get("b"));
		student.setAge(a+b);
		return "welcom";
	}
	public void getJson(){
		Map<String,String> params = FacesContext.getCurrentInstance().getExternalContext().getRequestParameterMap();
		int a=Integer.parseInt(params.get("a"));
		int b=Integer.parseInt(params.get("b"));
		List<Student> students=getListStudent();
		FacesContext facesContext = FacesContext.getCurrentInstance();
	    ExternalContext externalContext = facesContext.getExternalContext();
	    externalContext.setResponseContentType("application/json");
	    externalContext.setResponseCharacterEncoding("UTF-8");
	    try {
			externalContext.getResponseOutputWriter().write(Student.toJsonArray(students));
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	    facesContext.responseComplete();
//	    return Student.toJsonArray(students);
	}
}
