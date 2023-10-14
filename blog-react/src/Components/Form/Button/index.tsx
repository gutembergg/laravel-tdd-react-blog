import { ButtonHTMLAttributes, ReactNode } from 'react';
import { twMerge } from 'tailwind-merge';

interface ButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {
    children: ReactNode;
}

function Button({ children, ...rest }: ButtonProps) {
    const props = rest['className'];
    return (
        <button {...rest} type="button" className={twMerge(`${props} `)}>
            {children}
        </button>
    );
}

export default Button;
