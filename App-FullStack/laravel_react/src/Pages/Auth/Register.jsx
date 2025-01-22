import { useState } from "react";

export default function Register(){

    const [formData, setFormData] = useState({
        name:  "",
        email: "",
        password:"",
        password_confirmation: "",
    });

    const [errors, setErrors] = useState({

    })

    async function handleRegister(e){
        e.preventDefault()
        const res = await fetch('/api/register', {
            method: "post",
            body: JSON.stringify(formData),
        });

        const data = await res.jason()

        if (data.error) {
            setErrors(data.errors)
        } else {
            console.log(data);
        }

        console.log(data);
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
                     {errors.name && <p className="error">{errors.name}</p>}
                </div>
                <div>
                    <input type="text" placeholder="Email"
                            value={formData.email}
                                onChange={(e) => setFormData( 
                                {...formData, email: e.target.value}
                            )
                        }     
                     />
                </div>
                <div>
                    <input type="password" placeholder="Senha"
                            value={formData.password}
                                onChange={(e) => setFormData( 
                                {...formData, password: e.target.value}
                            )
                        }     
                     />
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