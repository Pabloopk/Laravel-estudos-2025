import { Link, Outlet } from "react-router-dom";

export default function Layout(){

    return(
        <>
            <header>
                <nav>
                    <Link to="/" className="nav-link">Home</Link>
                </nav>
            </header>
            <main>
                <Outlet/>
            </main>
        </>
    );
}