import { Component, OnInit, Input } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-book',
  templateUrl: './book.component.html',
  styleUrls: ['./book.component.scss'],
})
export class BookComponent implements OnInit {

  @Input() id:number = 0;
  @Input() img:string = "test2_auth.png";
  url:string;
  @Input() title:string = "N/A";
  @Input() author:string = "N/A";
  @Input() available:boolean = false;
  @Input() reading:boolean = false;

  constructor(private router: Router) { }

  ngOnInit() {
    this.url = "http://" + localStorage.getItem('domain') + "/book_images/" + this.img;
  }

  loadbook(id, url, title, author, available, reading) {
    this.router.navigate(["/bookview"], {state: { id, url, title, author, available, reading }});
  }

}
