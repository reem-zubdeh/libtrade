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

}
