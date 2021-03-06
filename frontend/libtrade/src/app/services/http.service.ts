import { Injectable } from '@angular/core';
import { HttpClient } from  '@angular/common/http';

@Injectable({
  providedIn: 'root'
})


export class HttpService {

  base_url:string = localStorage.getItem("domain");
  
  constructor(private http: HttpClient) { }

  addBook(book) {
    return this.http.post(this.base_url + "/add_book.php", book);
  }

  login(user) {
    return this.http.post(this.base_url + "/login.php", user);
  }

  signup(user) {
    return this.http.post(this.base_url + "/singup.php", user);
  }

  getBooks() {
    return this.http.get(this.base_url + "/get_books.php?user_id=" + localStorage.getItem("id"));
  }

  findBooks(q) {
    return this.http.get(this.base_url + "/get_books.php?q=" + q);
  }

  getProfile() {
    return this.http.get(this.base_url + "/view_profile.php?user_id=" + localStorage.getItem("id"));
  }

}
