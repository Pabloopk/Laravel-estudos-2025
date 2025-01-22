import { Link, Outlet } from "react-router-dom";

export default function Layout(){

    return(
        <>
            <header>
                <nav>
                    <Link to="/" className="nav-link">Home</Link>

                    <div className="space-x-4">
                        <Link to="/register" className="nav-link">Registre-se</Link>
                        <Link to="/login" className="nav-link">Entrar</Link>
                    </div>
                </nav>
            </header>
            <main>
                <Outlet/>
            </main>
        </>
    );
}