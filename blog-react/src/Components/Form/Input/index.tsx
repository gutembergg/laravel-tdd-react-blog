import { ElementType, InputHTMLAttributes } from 'react';

interface InputProps extends InputHTMLAttributes<HTMLInputElement> {
    icon?: ElementType;
}

function Input({ icon: Icon, ...rest }: InputProps) {
    return (
        <div className={`w-full flex items-center p-2 border ${rest.className}`}>
            {Icon && <Icon color="white" />}
            <input
                {...rest}
                type={rest.type ? rest.type : 'text'}
                className="flex-1 w-[90%] border-none outline-none bg-transparent px-4 py-2 dark:text-white"
            />
        </div>
    );
}

export default Input;
