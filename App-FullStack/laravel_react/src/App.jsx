import { BrowserRouter, Routes, Route } from 'react-router-dom';
import './App.css'

export default function App() {
  return<BrowserRouter>
    <Routes>
      <Route path="/" element={<Layout/>}>
        <Route index element={<Homt/>}/>
      </Route>
    </Routes>
  </BrowserRouter>;
}


