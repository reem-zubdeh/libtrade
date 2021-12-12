import { Component, OnInit } from '@angular/core';
import { HttpService } from 'src/app/services/http.service';

@Component({
  selector: 'app-find',
  templateUrl: './find.page.html',
  styleUrls: ['./find.page.scss'],
})
export class FindPage implements OnInit {

  constructor( private httpService: HttpService) { }

  books;
    
  ngOnInit() {
  }

  search(event) {
    let q = event.detail.value;
    this.httpService.findBooks(q).subscribe(
      response => {
        this.books = response;
      }
    );
  }

}
