import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpService } from 'src/app/services/http.service';

@Component({
  selector: 'app-books',
  templateUrl: './books.page.html',
  styleUrls: ['./books.page.scss'],
})
export class BooksPage implements OnInit {

  constructor(private router: Router, private httpService: HttpService) { }

  books = JSON.parse(localStorage.getItem("books")).books;
  
  add() {
    this.router.navigate(["tabs/tabs/books/add"]);
  }

  ngOnInit() {
    this.httpService.getBooks().subscribe(
      response => {
        localStorage.setItem("books", JSON.stringify(response));
        this.books = JSON.parse(localStorage.getItem("books")).books;
      }
    );
  }

  ionViewDidLoad() {
    console.log("I'm alive!");
  }

}
