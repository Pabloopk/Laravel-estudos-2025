import { BrowserRouter, Routes, Route } from 'react-router-dom';
import './App.css'

export default function App() {
  return<BrowserRouter>
    <Routes>
      <Route path="/" element={<Layout/>}>
        <Route index element={<Home/>}/>
      </Route>
    </Routes>
  </BrowserRouter>;
}


