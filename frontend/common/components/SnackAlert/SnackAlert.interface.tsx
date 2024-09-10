import { AlertColor, SnackbarOrigin } from "@mui/material";
import { Dispatch, ReactElement, SetStateAction } from "react";

export interface SnackAlertParams {
  state: {
    open: boolean,
    message: string,
  };
  setState: Dispatch<SetStateAction<SnackAlertParams['state']>>; 
  severity: AlertColor;
  children?: string | ReactElement;
  key?: any;
  vertical?: SnackbarOrigin['vertical']; 
  horizontal?: SnackbarOrigin['horizontal']; 
  variant?: 'standard' | 'filled' | 'outlined';
  autoHideDuration?: number;
}