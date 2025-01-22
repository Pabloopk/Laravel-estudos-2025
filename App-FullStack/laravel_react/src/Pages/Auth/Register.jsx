import { useState } from "react";

export default function Register(){

    const [formData, setFormData] = useState({
        name:  '',
        email: '',
        password:'',
        password_confirmation: '',
    })

    function handleRegister(e){
        e.preventDefault()
        
        console.log(formData);
    }

    return(
        <>
            <h1 className="title">Registre Sua Nova Conta</h1>
            
            <form onSubmit={handleRegister} className="w-1/2 m-auto space-y-6">
                <div>
                    <input type="text" placeholder="Nome" value={formData.name}
                        onChange={(e) => setFormData({...formData, name: e.target.value})}       
                     />
                </div>
                <div>
                    <input type="text" placeholder="Email" />
                </div>
                <div>
                    <input type="password" placeholder="Senha" />
                </div>
                <div>
                    <input type="password" placeholder="Confirme a Senha" />
                </div>

               <div className="primary-btn">
                Registre-se
               </div>
                
            </form>
        </>
    );
}