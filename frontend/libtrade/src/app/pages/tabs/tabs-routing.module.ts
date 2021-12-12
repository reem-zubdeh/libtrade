import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TabsPage } from './tabs.page';

const routes: Routes = [
  {
    path: 'tabs',
    component: TabsPage,
    children: [
      {
        path: 'books',
        loadChildren: () => import('../books/books.module').then(m => m.BooksPageModule)
      },
      {
        path: 'books/add',
        loadChildren: () => import('../add/add.module').then(m => m.AddPageModule)
      },
      {
        path: 'find',
        loadChildren: () => import('../find/find.module').then(m => m.FindPageModule)
      },
      {
        path: 'profile',
        loadChildren: () => import('../profile/profile.module').then(m => m.ProfilePageModule)
      },
      {
        path: '',
        redirectTo: '/tabs/books',
        pathMatch: 'full'
      }
    ]
  },
  {
    path: '',
    redirectTo: '/tabs/books',
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
})
export class TabsPageRoutingModule {}
