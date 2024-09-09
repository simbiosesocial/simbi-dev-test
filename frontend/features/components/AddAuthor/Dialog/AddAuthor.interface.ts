import { Dispatch, SetStateAction } from "react";

export interface AuthorName {
  firstName: string;
  lastName: string;
}

export interface AddAuthorDialogProps {
  open: boolean,
  handleClose: () => void,
  handleSubmit: (event: React.FormEvent<HTMLFormElement>) => void,
  dialogValue: AuthorName
  setDialogValue: Dispatch<SetStateAction<AuthorName>>
}