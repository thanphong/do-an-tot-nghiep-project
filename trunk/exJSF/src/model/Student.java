package model;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;
@Entity
@Table(name="Student")
public class Student {
	@Id
	private String name;
	private int age;

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public int getAge() {
		return age;
	}
	public void setAge(int age) {
		this.age = age;
	}
	public String toJson() {

		return new JSONSerializer().exclude("*.class").serialize(this);
	}
	public static Student fromJsonToObject(String json) {
		return new JSONDeserializer<Student>().use(null, Student.class)
				.deserialize(json);
	}
	public static Collection<Student> fromJsonArrayToObject(String json) {
		return new JSONDeserializer<List<Student>>().use(null, ArrayList.class)
				.use("values", Student.class).deserialize(json);
	}
	public static String toJsonArray(Collection<Student> collection) {

		return new JSONSerializer().exclude("*.class").serialize(collection);
	}
}
