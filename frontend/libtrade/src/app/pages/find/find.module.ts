import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { FindPageRoutingModule } from './find-routing.module';

import { FindPage } from './find.page';

import { TabsComponent } from 'src/app/components/tabs/tabs.component';
@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    FindPageRoutingModule
  ],
  declarations: [FindPage, TabsComponent]
})
export class FindPageModule {}
