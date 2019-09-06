import { ModuleWithProviders } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";

import { AppComponent } from "./app.component";
import { SigninComponent } from "./signin/signin.component";
import { SignupComponent } from "./signup/signup.component";




const APP_ROUTES: Routes = [
  { path: 'Login', component: SigninComponent },
  { path: 'Register', component: SignupComponent },
];

export const routing: ModuleWithProviders = RouterModule.forRoot(APP_ROUTES , { enableTracing: true });
