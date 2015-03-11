package model;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.EntityManager;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Persistence;
import javax.persistence.Table;
import javax.persistence.TypedQuery;

import flexjson.JSONDeserializer;
import flexjson.JSONSerializer;

@Entity
@Table(name = "student")
public class Student {
	@Id
	@Column(name = "id", nullable = false)
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private int id;

	@Column(name = "name", nullable = false)
	private String name;

	public String getName() {
		return name;
	}
	public int getInt() {
		return id;
	}

	public void setInt(int id) {
		this.id = id;
	}

	public void setName(String name) {
		this.name = name;
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

	public void persist() {
		EntityManager em = Persistence.createEntityManagerFactory("exJSF")
				.createEntityManager();
		try {
			em.getTransaction().begin();
			em.persist(this);
			em.getTransaction().commit();
		} finally {
			em.close();
		}
	}
	public void remove(){
		EntityManager em = Persistence.createEntityManagerFactory("exJSF")
				.createEntityManager();
		try {
			em.getTransaction().begin();
			em.remove(this);
			em.getTransaction().commit();
		} finally {
			em.close();
		}
	}
	public void merge(){
		EntityManager em = Persistence.createEntityManagerFactory("exJSF")
				.createEntityManager();
		try {
			em.getTransaction().begin();
			em.merge(this);
			em.getTransaction().commit();
		} finally {
			em.close();
		}
	}
	public static Student findStudentById(int id){
		EntityManager em = Persistence.createEntityManagerFactory("exJSF")
				.createEntityManager();
		try {
			return em.find(Student.class, id);
		} finally {
			em.close();
		}
	}
	public static List<Student> getListAllStudent() {
		EntityManager em = Persistence.createEntityManagerFactory("exJSF")
				.createEntityManager();
		TypedQuery<Student> query = em.createQuery("select o from Student o",Student.class);
		List<Student> result = query.getResultList();
		return result;
	}
	public static List<Student> findStudent(String name){
		EntityManager em = Persistence.createEntityManagerFactory("exJSF")
				.createEntityManager();
		TypedQuery<Student> query = em.createQuery("select o from Student o where o.name= :name",Student.class);
		query.setParameter("name", name);
		return query.getResultList();
	}
}
