import { Component, OnInit } from '@angular/core';
import { HttpService } from 'src/app/services/http.service';

@Component({
  selector: 'app-tabs',
  templateUrl: './tabs.page.html',
  styleUrls: ['./tabs.page.scss'],
})
export class TabsPage implements OnInit {

  constructor(private httpService: HttpService) { }

  ngOnInit() {
  }

  getBooks() {
    this.httpService.getBooks().subscribe(
      response => {
        localStorage.setItem("books", JSON.stringify(response));
      }
    );
  }

}
