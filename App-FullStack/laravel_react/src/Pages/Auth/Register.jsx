import { useContext, useState } from "react";
import { useNavigate } from "react-router-dom";
import { AppContext } from "../../Context/AppContext";

export default function Register() {
  const { setToken } = useContext(AppContext);
  const navigate = useNavigate();

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });

  const [errors, setErrors] = useState({});

  async function handleRegister(e) {
    e.preventDefault();
    const res = await fetch("/api/register", {
      method: "post",
      body: JSON.stringify(formData),
    });

    const data = await res.json();

    if (data.errors) {
      setErrors(data.errors);
    } else {
      localStorage.setItem("token", data.token);
      setToken(data.token);
      navigate("/");
    }
  }

    return(
        <>
            <h1 className="title">Registre Sua Nova Conta</h1>
            
            <form onSubmit={handleRegister} className="w-1/2 m-auto space-y-6">
                <div>
                    <input type="text" placeholder="Nome" 
                        value={formData.name}
                        onChange={(e) => setFormData( 
                            {...formData, name: e.target.value}
                            )
                        }       
                     />
                     {errors.title && <p className="error">{errors.title[0]}</p>}
                </div>
                <div>
                    <input type="text" placeholder="Email"
                            value={formData.email}
                                onChange={(e) => setFormData( 
                                {...formData, email: e.target.value}
                            )
                        }     
                     />
                     {errors.title && <p className="error">{errors.email[0]}</p>}
                </div>
                <div>
                    <input type="password" placeholder="Senha"
                            value={formData.password}
                                onChange={(e) => setFormData( 
                                {...formData, password: e.target.value}
                            )
                        }     
                     />
                     {errors.title && <p className="error">{errors.password[0]}</p>}
                </div>
                <div>
                    <input type="password" placeholder="Confirme a Senha" 
                            value={formData.password_confirmation}
                            onChange={(e) => setFormData( 
                            {...formData, password_confirmation: e.target.value}
                            )
                        }     

                    />
                </div>

               <div className="primary-btn">
                Registre-se
               </div>
                
            </form>
        </>
    );
}