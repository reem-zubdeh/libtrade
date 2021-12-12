import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent implements OnInit{

  constructor() {}
  
  loggedIn() {
    return localStorage.getItem('id') != '0';
  }

  ngOnInit() {
    localStorage.setItem('domain', 'http://localhost');
    localStorage.setItem('id', '0');
  }

}