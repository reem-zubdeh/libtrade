import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-book',
  templateUrl: './book.component.html',
  styleUrls: ['./book.component.scss'],
})
export class BookComponent implements OnInit {

  @Input() img:string = "test2_auth.png";
  url:string;

  constructor() { }

  ngOnInit() {
    this.url = "http://" + localStorage.getItem('domain') + "/book_images/" + this.img;
    console.log(this.url);
  }

}
