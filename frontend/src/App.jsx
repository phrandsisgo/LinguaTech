import { Routes, Route, Navigate } from 'react-router-dom';
import { useAuth } from './context/AuthContext';
import { AuthProvider } from './context/AuthContext';
import Layout from './components/Layout';

import LoginPage from './pages/auth/LoginPage';
import RegisterPage from './pages/auth/RegisterPage';
import ForgotPasswordPage from './pages/auth/ForgotPasswordPage';
import HomePage from './pages/HomePage';
import DashboardPage from './pages/DashboardPage';
import LibraryPage from './pages/library/LibraryPage';
import ListShowPage from './pages/library/ListShowPage';
import ListCreatePage from './pages/library/ListCreatePage';
import ListUpdatePage from './pages/library/ListUpdatePage';
import CopyListPage from './pages/library/CopyListPage';
import SwipeLearnPage from './pages/SwipeLearnPage';
import TextsPage from './pages/texts/TextsPage';
import TextShowPage from './pages/texts/TextShowPage';
import AddTextPage from './pages/texts/AddTextPage';
import UpdateTextPage from './pages/texts/UpdateTextPage';
import GenerateTextPage from './pages/texts/GenerateTextPage';
import ProfilePage from './pages/profile/ProfilePage';
import InitiateProfilePage from './pages/profile/InitiateProfilePage';
import StripePage from './pages/StripePage';
import AboutMePage from './pages/AboutMePage';
import AboutProjectPage from './pages/AboutProjectPage';
import PatchListPage from './pages/patchnotes/PatchListPage';
import PatchShowPage from './pages/patchnotes/PatchShowPage';

function PrivateRoute({ children }) {
  const { user, loading } = useAuth();
  if (loading) return <div className="flex justify-center items-center h-screen">Laden...</div>;
  return user ? children : <Navigate to="/login" replace />;
}

function GuestRoute({ children }) {
  const { user, loading } = useAuth();
  if (loading) return <div className="flex justify-center items-center h-screen">Laden...</div>;
  return !user ? children : <Navigate to="/home" replace />;
}

export default function App() {
  return (
    <AuthProvider>
      <Routes>
        {/* Guest Routes */}
        <Route path="/login" element={<GuestRoute><LoginPage /></GuestRoute>} />
        <Route path="/register" element={<GuestRoute><RegisterPage /></GuestRoute>} />
        <Route path="/forgot-password" element={<GuestRoute><ForgotPasswordPage /></GuestRoute>} />

        {/* Protected Routes */}
        <Route element={<Layout />}>
          <Route path="/" element={<Navigate to="/home" replace />} />
          <Route path="/home" element={<PrivateRoute><HomePage /></PrivateRoute>} />
          <Route path="/dashboard" element={<PrivateRoute><DashboardPage /></PrivateRoute>} />
          <Route path="/library" element={<PrivateRoute><LibraryPage /></PrivateRoute>} />
          <Route path="/list-show/:id" element={<PrivateRoute><ListShowPage /></PrivateRoute>} />
          <Route path="/list-create" element={<PrivateRoute><ListCreatePage /></PrivateRoute>} />
          <Route path="/list-update/:id" element={<PrivateRoute><ListUpdatePage /></PrivateRoute>} />
          <Route path="/copy-list/:id" element={<PrivateRoute><CopyListPage /></PrivateRoute>} />
          <Route path="/swipe-learn/:id" element={<PrivateRoute><SwipeLearnPage /></PrivateRoute>} />
          <Route path="/texts" element={<PrivateRoute><TextsPage /></PrivateRoute>} />
          <Route path="/text/:id" element={<PrivateRoute><TextShowPage /></PrivateRoute>} />
          <Route path="/add-text" element={<PrivateRoute><AddTextPage /></PrivateRoute>} />
          <Route path="/update-text/:id" element={<PrivateRoute><UpdateTextPage /></PrivateRoute>} />
          <Route path="/generate-text" element={<PrivateRoute><GenerateTextPage /></PrivateRoute>} />
          <Route path="/profile" element={<PrivateRoute><ProfilePage /></PrivateRoute>} />
          <Route path="/initiate-profile" element={<PrivateRoute><InitiateProfilePage /></PrivateRoute>} />
          <Route path="/stripe" element={<StripePage />} />
          <Route path="/about-me" element={<AboutMePage />} />
          <Route path="/about-project" element={<AboutProjectPage />} />
          <Route path="/patch-notes" element={<PatchListPage />} />
          <Route path="/patch-notes/:id" element={<PatchShowPage />} />
        </Route>
      </Routes>
    </AuthProvider>
  );
}
