class CreateHostelCommand {
  private readonly name: string;
  private readonly email: string;
  private readonly address: string;
  private readonly cuit: number;
  private readonly password: string;
  private readonly tinyDescription: string;
  constructor(name: string, email: string, address: string, cuit: number, password: string, tinyDescription: string) {
    this.name = name;
    this.email = email;
    this.address = address;
    this.cuit = cuit;
    this.password = password;
    this.tinyDescription = tinyDescription;
  }

  getName(): string {
    return this.name;
  }
  getEmail(): string {
    return this.email;
  }
  getAddress(): string {
    return this.address;
  }
  getCuit(): number {
    return this.cuit;
  }
  getPassword(): string {
    return this.password;
  }
  getTinyDescription(): string {
    return this.tinyDescription;
  }
}

export default CreateHostelCommand;
