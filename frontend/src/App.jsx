import React from 'react';
import { Routes, Route } from 'react-router-dom';
import { AuthProvider } from './contexts/AuthContext';
import MainLayout from './components/MainLayout';

// Pages
import Welcome from './pages/Welcome';
import Home from './pages/Home';
import Library from './pages/Library';
import ListShow from './pages/ListShow';
import ListCreate from './pages/ListCreate';
import ListUpdate from './pages/ListUpdate';
import CopyList from './pages/CopyList';
import SwipeLearn from './pages/SwipeLearn';
import SwipePlay from './pages/SwipePlay';
import DisplayAllTexts from './pages/DisplayAllTexts';
import TextShow from './pages/TextShow';
import NewText from './pages/NewText';
import UpdateText from './pages/UpdateText';
import GenerateText from './pages/GenerateText';
import TextPlay from './pages/TextPlay';
import Profile from './pages/Profile';
import InitiateProfile from './pages/InitiateProfile';
import Login from './pages/Login';
import Register from './pages/Register';
import ForgotPassword from './pages/ForgotPassword';
import ResetPassword from './pages/ResetPassword';
import Dashboard from './pages/Dashboard';
import AboutMe from './pages/AboutMe';
import AboutProject from './pages/AboutProject';
import Playground from './pages/Playground';
import Stripe from './pages/Stripe';
import SuccessPayment from './pages/SuccessPayment';
import CancelPayment from './pages/CancelPayment';
import PaymentFailed from './pages/PaymentFailed';
import PatchList from './pages/PatchList';
import PatchShow from './pages/PatchShow';
import Spielwiese from './pages/Spielwiese';

function App() {
  return (
    <AuthProvider>
      <MainLayout>
        <Routes>
          <Route path="/" element={<Welcome />} />
          <Route path="/home" element={<Home />} />
          <Route path="/library" element={<Library />} />
          <Route path="/list_show/:id" element={<ListShow />} />
          <Route path="/list_create" element={<ListCreate />} />
          <Route path="/list_update/:id" element={<ListUpdate />} />
          <Route path="/copy_list/:id" element={<CopyList />} />
          <Route path="/swipeLearn/:id" element={<SwipeLearn />} />
          <Route path="/swipePlay" element={<SwipePlay />} />
          <Route path="/displayAllTexts" element={<DisplayAllTexts />} />
          <Route path="/textShow/:id" element={<TextShow />} />
          <Route path="/addText" element={<NewText />} />
          <Route path="/updateText/:id" element={<UpdateText />} />
          <Route path="/generate-text/:deck_id?" element={<GenerateText />} />
          <Route path="/textPlay" element={<TextPlay />} />
          <Route path="/profile" element={<Profile />} />
          <Route path="/initiateProfile" element={<InitiateProfile />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/forgot-password" element={<ForgotPassword />} />
          <Route path="/reset-password" element={<ResetPassword />} />
          <Route path="/dashboard" element={<Dashboard />} />
          <Route path="/about_me" element={<AboutMe />} />
          <Route path="/about_project" element={<AboutProject />} />
          <Route path="/playground" element={<Playground />} />
          <Route path="/stripe" element={<Stripe />} />
          <Route path="/success" element={<SuccessPayment />} />
          <Route path="/cancel" element={<CancelPayment />} />
          <Route path="/payment-failed" element={<PaymentFailed />} />
          <Route path="/patchList" element={<PatchList />} />
          <Route path="/patch_show/:id" element={<PatchShow />} />
          <Route path="/spielwiese" element={<Spielwiese />} />
        </Routes>
      </MainLayout>
    </AuthProvider>
  );
}

export default App;
