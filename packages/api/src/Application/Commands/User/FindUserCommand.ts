class FindUserCommand {
  private readonly name: string;
  private readonly email: string;
  private readonly phone: string;
  private readonly password: string;
  constructor(name: string, email: string, phone: string, password: string) {
    this.name = name;
    this.email = email;
    this.phone = phone;
    this.password = password;
  }

  getName(): string {
    return this.name;
  }
  getEmail(): string {
    return this.email;
  }
  getPhone(): string {
    return this.phone;
  }
  getPassword(): string {
    return this.password;
  }
}

export default FindUserCommand;
