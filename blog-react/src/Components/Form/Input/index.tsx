import { ElementType, InputHTMLAttributes } from 'react';

interface InputProps extends InputHTMLAttributes<HTMLInputElement> {
    icon?: ElementType;
}

function Input({ icon: Icon, ...rest }: InputProps) {
    return (
        <div className="w-full flex items-center p-2 border">
            {Icon && <Icon />}
            <input {...rest} type={rest.type ? rest.type : 'text'} className="flex-1 w-[90%] border-none outline-none bg-transparent pl-4" />
        </div>
    );
}

export default Input;
