import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent implements OnInit{

  constructor() {}
  
  loggedIn() {
    // return await this.storage.get('loggedIn');
    return localStorage.getItem('loggedIn') == 'true';
  }

  ngOnInit() {
  }

}