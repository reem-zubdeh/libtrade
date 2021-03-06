import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-book',
  templateUrl: './book.component.html',
  styleUrls: ['./book.component.scss'],
})
export class BookComponent implements OnInit {

  @Input() img:string = "test2_auth.png";
  url:string;
  @Input() title:string = "N/A";
  @Input() author:string = "N/A";
  @Input() owned:number = 0;

  constructor() { }

  ngOnInit() {
    this.url = localStorage.getItem('domain') + "/book_images/" + this.img;
  }

}
